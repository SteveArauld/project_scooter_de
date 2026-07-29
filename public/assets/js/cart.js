/**
 * E-Roller Shop – Warenkorb (localStorage)
 * Kein Login erforderlich. Der Warenkorb wird im Browser gespeichert.
 */
(function () {
  "use strict";

  var STORAGE_KEY = "eroller_cart_v1";

  function euro(value) {
    return new Intl.NumberFormat("de-DE", {
      style: "currency",
      currency: "EUR",
    }).format(value || 0);
  }

  var Cart = {
    items: function () {
      try {
        return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
      } catch (e) {
        return [];
      }
    },
    save: function (items) {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
      document.dispatchEvent(new CustomEvent("cart:updated", { detail: items }));
    },
    count: function () {
      return this.items().reduce(function (n, i) {
        return n + (i.qty || 0);
      }, 0);
    },
    total: function () {
      return this.items().reduce(function (s, i) {
        return s + (i.price || 0) * (i.qty || 0);
      }, 0);
    },
    add: function (product, qty) {
      qty = parseInt(qty, 10) || 1;
      var items = this.items();
      var found = items.find(function (i) {
        return i.slug === product.slug;
      });
      if (found) {
        found.qty += qty;
        // Erscheinungsdatum nachziehen, falls es beim ersten Hinzufügen fehlte
        found.preorder = product.preorder || found.preorder || null;
      } else {
        items.push({
          slug: product.slug,
          title: product.title,
          price: parseFloat(product.price) || 0,
          image: product.image || "",
          url: product.url || "#",
          preorder: product.preorder || null,
          qty: qty,
        });
      }
      this.save(items);
    },
    setQty: function (slug, qty) {
      qty = parseInt(qty, 10) || 1;
      if (qty < 1) qty = 1;
      var items = this.items();
      var found = items.find(function (i) {
        return i.slug === slug;
      });
      if (found) {
        found.qty = qty;
        this.save(items);
      }
    },
    remove: function (slug) {
      var items = this.items().filter(function (i) {
        return i.slug !== slug;
      });
      this.save(items);
    },
    clear: function () {
      this.save([]);
    },
  };

  window.Cart = Cart;
  window.euroFormat = euro;

  /* ---- Toast-Benachrichtigung ---- */
  function showToast(title) {
    var wrap = document.getElementById("cartToastWrap");
    if (!wrap) {
      wrap = document.createElement("div");
      wrap.id = "cartToastWrap";
      wrap.style.cssText =
        "position:fixed;top:20px;right:20px;z-index:1090;display:flex;flex-direction:column;gap:8px;";
      document.body.appendChild(wrap);
    }
    var t = document.createElement("div");
    t.style.cssText =
      "background:#198754;color:#fff;padding:12px 18px;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,.15);" +
      "font-size:14px;max-width:320px;opacity:0;transform:translateX(20px);transition:all .25s ease;";
    t.innerHTML =
      '<strong><i class="bi bi-check-circle-fill me-2"></i>Zum Warenkorb hinzugefügt</strong>' +
      (title ? '<div style="opacity:.85;margin-top:2px">' + title + "</div>" : "");
    wrap.appendChild(t);
    requestAnimationFrame(function () {
      t.style.opacity = "1";
      t.style.transform = "translateX(0)";
    });
    setTimeout(function () {
      t.style.opacity = "0";
      t.style.transform = "translateX(20px)";
      setTimeout(function () {
        t.remove();
      }, 250);
    }, 2200);
  }
  window.showCartToast = showToast;

  /* ---- Schnellansicht (Quick View) ---- */
  function fillThumbs(modalEl, images) {
    var thumbs = modalEl.querySelector("#qvThumbnails");
    var main = modalEl.querySelector("#qvImage");
    if (!thumbs) return;
    thumbs.innerHTML = images
      .slice(0, 4)
      .map(function (src) {
        return (
          '<div class="col-3"><div class="border rounded p-2 qv-thumb" style="cursor:pointer" data-src="' +
          src +
          '"><img src="' + src + '" alt="" class="img-fluid" style="height:64px;object-fit:contain;width:100%"></div></div>'
        );
      })
      .join("");
    thumbs.querySelectorAll(".qv-thumb").forEach(function (t) {
      t.addEventListener("click", function () {
        main.src = t.getAttribute("data-src");
      });
    });
  }

  /**
   * Vorbestellung in der Schnellansicht abbilden: Hinweisbox einblenden und
   * den Kauf-Button in einen Vorbestell-Button umschalten.
   * product === null setzt den Ausgangszustand (lieferbar) wieder her.
   */
  function setPreorderState(modalEl, product) {
    var box = modalEl.querySelector("#qvPreorder");
    var addBtn = modalEl.querySelector("#qvAddToCart");
    var avail = modalEl.querySelector("#qvAvailability");
    if (!addBtn) return;

    var isPreorder = !!(product && product.is_preorder);

    if (box) {
      box.classList.toggle("d-none", !isPreorder);
      box.innerHTML = isPreorder
        ? '<span class="fw-semibold d-block">Vorbestellung – noch nicht lieferbar</span>' +
          "Erscheint am " + (product.release_label || product.release_date || "") + "."
        : "";
    }
    if (avail && isPreorder) avail.textContent = "";

    addBtn.classList.toggle("btn-warning", isPreorder);
    addBtn.classList.toggle("btn-primary", !isPreorder);
    addBtn.innerHTML = isPreorder
      ? '<i class="feather-icon icon-clock me-2"></i>Jetzt vorbestellen'
      : '<i class="feather-icon icon-shopping-bag me-2"></i>In den Warenkorb';
    addBtn.setAttribute(
      "data-added-label",
      isPreorder
        ? "<i class='bi bi-check-lg me-2'></i>Vorbestellt"
        : "<i class='bi bi-check-lg me-2'></i>Hinzugefügt"
    );
    if (isPreorder) {
      addBtn.setAttribute("data-preorder", product.release_date || "");
    } else {
      addBtn.removeAttribute("data-preorder");
    }
  }

  function openQuickView(el) {
    var modalEl = document.getElementById("quickViewModal");
    if (!modalEl || !window.bootstrap) return;
    var d = el.dataset;

    // Sofort verfügbare Basisdaten aus dem Kartendatensatz anzeigen
    modalEl.querySelector("#qvImage").src = d.image || "";
    modalEl.querySelector("#qvCategory").textContent = d.category || "";
    modalEl.querySelector("#qvTitle").textContent = d.title || "";
    modalEl.querySelector("#qvBrand").textContent = d.brand ? "Marke: " + d.brand : "";
    modalEl.querySelector("#qvPrice").textContent = d.price || "";
    modalEl.querySelector("#qvAvailability").textContent = d.availability || "";
    modalEl.querySelector("#qvDesc").textContent = "Wird geladen …";
    modalEl.querySelector("#qvDetails").href = d.url || "#";
    var qty = modalEl.querySelector("#qvQty");
    if (qty) qty.value = 1;
    fillThumbs(modalEl, [d.image || ""]);

    // Vorbestell-Zustand zurücksetzen, bis die vollständigen Daten geladen sind
    setPreorderState(modalEl, null);

    var addBtn = modalEl.querySelector("#qvAddToCart");
    addBtn.setAttribute("data-slug", d.slug || "");
    addBtn.setAttribute("data-title", d.title || "");
    addBtn.setAttribute("data-price", d.priceRaw || "0");
    addBtn.setAttribute("data-image", d.image || "");
    addBtn.setAttribute("data-url", d.url || "#");

    bootstrap.Modal.getOrCreateInstance(modalEl).show();

    // Vollständige Daten (alle Bilder + Beschreibung) per AJAX laden
    if (d.slug) {
      fetch("/api/produkt/" + encodeURIComponent(d.slug), { headers: { "X-Requested-With": "XMLHttpRequest" } })
        .then(function (r) { return r.ok ? r.json() : null; })
        .then(function (p) {
          if (!p) { modalEl.querySelector("#qvDesc").textContent = ""; return; }
          modalEl.querySelector("#qvDesc").textContent = p.description || "";
          modalEl.querySelector("#qvAvailability").textContent = p.availability || "";
          setPreorderState(modalEl, p);
          if (p.images && p.images.length) fillThumbs(modalEl, p.images);
        })
        .catch(function () { modalEl.querySelector("#qvDesc").textContent = ""; });
    }
  }
  window.openQuickView = openQuickView;

  /* ---- Badge & Offcanvas Rendering ---- */

  function renderBadge() {
    var count = Cart.count();
    document.querySelectorAll("[data-cart-count]").forEach(function (el) {
      el.textContent = count;
    });
    document.querySelectorAll("[data-cart-total]").forEach(function (el) {
      el.textContent = euro(Cart.total());
    });
  }

  function renderOffcanvas() {
    var box = document.querySelector("[data-cart-offcanvas-items]");
    if (!box) return;
    var items = Cart.items();
    if (!items.length) {
      box.innerHTML =
        '<div class="text-center py-8"><i class="feather-icon icon-shopping-bag fs-2 text-muted"></i>' +
        '<p class="mt-3 mb-0">Ihr Warenkorb ist leer.</p></div>';
    } else {
      box.innerHTML = items
        .map(function (i) {
          return (
            '<li class="list-group-item px-0 border-bottom py-3">' +
            '<div class="d-flex align-items-center">' +
            '<img src="' + i.image + '" alt="" style="width:64px;height:64px;object-fit:contain" class="me-3" />' +
            '<div class="flex-grow-1">' +
            '<a href="' + i.url + '" class="text-inherit text-decoration-none fw-medium d-block small">' + i.title + "</a>" +
            '<div class="small text-muted">' + i.qty + " × " + euro(i.price) + "</div>" +
            "</div>" +
            '<div class="text-end ms-2">' +
            '<div class="fw-bold small">' + euro(i.price * i.qty) + "</div>" +
            '<a href="#!" class="text-danger small" data-cart-remove="' + i.slug + '"><i class="feather-icon icon-trash-2"></i></a>' +
            "</div></div></li>"
          );
        })
        .join("");
    }
    var footer = document.querySelector("[data-cart-offcanvas-footer]");
    if (footer) footer.style.display = items.length ? "block" : "none";
  }

  function renderAll() {
    renderBadge();
    renderOffcanvas();
  }

  document.addEventListener("cart:updated", renderAll);
  document.addEventListener("DOMContentLoaded", renderAll);

  /* ---- Delegated click handlers ---- */

  document.addEventListener("click", function (e) {
    var addBtn = e.target.closest("[data-add-to-cart]");
    if (addBtn) {
      e.preventDefault();
      var qty = 1;
      if (addBtn.hasAttribute("data-qty-from-input")) {
        var qtyInput = document.querySelector("[data-qty-input]");
        if (qtyInput) qty = parseInt(qtyInput.value, 10) || 1;
      }
      if (addBtn.hasAttribute("data-qty-from-modal")) {
        var qvQty = document.getElementById("qvQty");
        if (qvQty) qty = parseInt(qvQty.value, 10) || 1;
      }
      Cart.add(
        {
          slug: addBtn.getAttribute("data-slug"),
          title: addBtn.getAttribute("data-title"),
          price: addBtn.getAttribute("data-price"),
          image: addBtn.getAttribute("data-image"),
          url: addBtn.getAttribute("data-url"),
          preorder: addBtn.getAttribute("data-preorder"),
        },
        qty
      );
      // Kleine Bestätigung am Button
      var original = addBtn.getAttribute("data-added-label");
      if (original !== null) {
        var prev = addBtn.innerHTML;
        addBtn.innerHTML = original;
        setTimeout(function () {
          addBtn.innerHTML = prev;
        }, 1200);
      }
      // Dezenter Hinweis (Toast) statt Warenkorb zu öffnen – besseres UX
      showToast(addBtn.getAttribute("data-title"));
      return;
    }

    var qv = e.target.closest("[data-quick-view]");
    if (qv) {
      e.preventDefault();
      openQuickView(qv);
      return;
    }

    var rm = e.target.closest("[data-cart-remove]");
    if (rm) {
      e.preventDefault();
      Cart.remove(rm.getAttribute("data-cart-remove"));
      return;
    }
  });
})();
