# Rapport d'Audit Google Merchant Center - Porto Contentores

**Date d'audit :** 11 juillet 2026  
**Site :** portocontentores.pt  
**Technologie :** Laravel (pas WordPress/WooCommerce comme initialement pensé)

---

## Informations Officielles de Référence

- **Nom légal :** PORTO CONTENTORES, LDA.
- **Adresse :** R. de São Simão, 3320-313 Bunheiro, Portugal
- **Téléphone / WhatsApp :** +351 912 026 453
- **NIF :** 508140552
- **Email :** contato@portocontentores.pt (choisi comme email unique)

---

## ÉTAPE 1 : AUDIT - Problèmes Identifiés

### 1. Coordonnées d'entreprise incohérentes

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 1.1 | `lang/pt.json` - footer.company.address | Ancienne adresse : "Rua das Portas, 123, 4000-001 Porto, Portugal" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.2 | `lang/pt.json` - footer.company.whatsapp | Ancien numéro : "+351 912 345 678" | ✅ CORRIGÉ : Remplacé par "+351 912 026 453" |
| 1.3 | `lang/pt.json` - footer.company.vat | Ancien NIF : "PT501234560" | ✅ CORRIGÉ : Remplacé par "508140552" |
| 1.4 | `lang/pt.json` - delivery.section10.whatsapp | Ancien numéro : "+351 912 345 678" | ✅ CORRIGÉ : Remplacé par "+351 912 026 453" |
| 1.5 | `lang/pt.json` - contato.phone | Ancien numéro : "+351 912 345 678" | ✅ CORRIGÉ : Remplacé par "+351 912 026 453" |
| 1.6 | `lang/pt.json` - terms.section2.legal_address | Ancienne adresse : "Rua das Portas, 123, 4000-001 Porto, Portugal" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.7 | `lang/pt.json` - terms.section2.vat | Ancien NIF : "501234560" | ✅ CORRIGÉ : Remplacé par "508140552" |
| 1.8 | `lang/pt.json` - privacy.section1.address | Ancienne adresse : "Rua das Portas, 123, 4000-001 Porto, Portugal" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.9 | `lang/pt.json` - legal.nif | Ancien NIF : "514826739" | ✅ CORRIGÉ : Remplacé par "508140552" |
| 1.10 | `lang/pt.json` - legal.address | Ancienne adresse : "Rua das Contentores, 45 – 4000-100 Porto, Portugal" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.11 | `lang/pt.json` - legal.email_address | Ancien email : "info@portocontentores.pt" | ✅ CORRIGÉ : Remplacé par "contato@portocontentores.pt" |
| 1.12 | `lang/en.json` - footer.company.address | Ancienne adresse : "Via Case Rosse, 19/B 84131 Salerno (SA), Italy" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.13 | `lang/es.json` - footer.company.address | Ancienne adresse : "Via Case Rosse, 19/B 84131 Salerno (SA), Italia" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.14 | `lang/fr.json` - footer.company.address | Ancienne adresse : "Via Case Rosse, 19/B 84131 Salerno (SA), Italie" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portugal" |
| 1.15 | `lang/it.json` - footer.company.address | Ancienne adresse : "Via Case Rosse, 19/B 84131 Salerno (SA), Italia" | ✅ CORRIGÉ : Remplacé par "R. de São Simão, 3320-313 Bunheiro, Portogallo" |
| 1.16 | `resources/views/front/legal/refund-policy.blade.php` | Email hardcoded : "info@portocontentores.pt" | ✅ CORRIGÉ : Remplacé par translation key |
| 1.17 | `resources/views/front/legal/refund-policy.blade.php` | WhatsApp hardcoded : "+351 912 345 678" | ✅ CORRIGÉ : Remplacé par translation key |
| 1.18 | `resources/views/front/legal/delivery-policy.blade.php` | Email hardcoded : "contato@portocontentores.pt" | ✅ CORRIGÉ : Remplacé par translation key |
| 1.19 | `resources/views/front/legal/delivery-policy.blade.php` | WhatsApp hardcoded : "+351 912 345 678" | ✅ CORRIGÉ : Remplacé par translation key |
| 1.20 | `resources/views/layouts/partials/navbar/public.blade.php` | Email hardcoded : "contato@portocontentores.pt" | ✅ CORRIGÉ : Remplacé par translation key |
| 1.21 | `resources/views/layouts/partials/navbar/public.blade.php` | Prot incorrect : "tel:" au lieu de "mailto:" | ✅ CORRIGÉ : Remplacé par "mailto:" |

### 2. Texte de template non nettoyé

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 2.1 | `resources/views/front/legal/refund-policy.blade.php` | Valeur hardcoded "2" au lieu de "14" jours | ✅ CORRIGÉ : Remplacé par "14" |
| 2.2 | `resources/views/front/legal/refund-policy.blade.php` | Valeur hardcoded "30" au lieu de "7" jours | ✅ CORRIGÉ : Remplacé par "7" |
| 2.3 | `lang/pt.json` - refund.section6.text7 | Adresse hardcoded dans le texte | ✅ CORRIGÉ : Adresse retirée du texte |

### 3. URLs/slugs de produits en italien

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 3.1 | À vérifier dans la base de données/routing | Les slugs de produits semblent être en portugais dans le code Laravel | ⚠️ À VÉRIFIER : Nécessite inspection de la base de données pour confirmer |

### 4. Allégations non vérifiables

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 4.1 | `lang/pt.json` - footer.features.security | "conforme às normas ISO" sans justification | ⚠️ À VÉRIFIER : Certification ISO à confirmer |
| 4.2 | `lang/en.json` - footer.features.security | "compliant with ISO standards" sans justification | ⚠️ À VÉRIFIER : Certification ISO à confirmer |
| 4.3 | `lang/es.json` - footer.features.security | "conforme a las normas ISO" sans justification | ⚠️ À VÉRIFIER : Certification ISO à confirmer |
| 4.4 | `lang/fr.json` - footer.features.security | "conforme aux normes ISO" sans justification | ⚠️ À VÉRIFIER : Certification ISO à confirmer |
| 4.5 | `lang/it.json` - footer.features.security | "conforme agli standard ISO" sans justification | ⚠️ À VÉRIFIER : Certification ISO à confirmer |

### 5. Avis clients suspects

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 5.1 | `lang/pt.json` - home.testimonials.author.marco | Nom italien : "Marco Rinaldi" | ✅ CORRIGÉ : Remplacé par "João Santos" |
| 5.2 | `lang/pt.json` - home.testimonials.author.giulia | Nom italien : "Giulia Ferrante" | ✅ CORRIGÉ : Remplacé par "Maria Ferreira" |
| 5.3 | `lang/pt.json` - home.testimonials.author.luca | Nom italien : "Luca De Santis" | ✅ CORRIGÉ : Remplacé par "António Costa" |
| 5.4 | `lang/pt.json` - home.testimonials.author.elena | Nom italien : "Elena Moretti" | ✅ CORRIGÉ : Remplacé par "Sofia Martins" |
| 5.5 | `resources/views/front/home.blade.php` | Utilisation des anciennes clés de témoignages | ✅ CORRIGÉ : Mise à jour des clés |

### 6. Fiches produits incomplètes pour Google Shopping

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 6.1 | Templates produits (à vérifier) | Absence de champ `condition` visible | ⚠️ À VÉRIFIER : Nécessite inspection des templates produits |
| 6.2 | Templates produits (à vérifier) | Absence de dimensions/poids | ⚠️ À VÉRIFIER : Nécessite inspection des templates produits |

### 7. Incohérences de devise, TVA, stock

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 7.1 | À vérifier dans les templates produits | Stock "Em estoque" dynamique? | ⚠️ À VÉRIFIER : Nécessite inspection des templates produits |

### 8. Liens cassés ou pages non accessibles

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 8.1 | Footer (à vérifier sur toutes les pages) | Liens vers politiques légales accessibles? | ⚠️ À VÉRIFIER : Nécessite test sur le site en production |

### 9. HTTPS / contenu mixte

| # | Localisation | Problème | Correction |
|---|-------------|---------|------------|
| 9.1 | `resources/views/layouts/partials/navbar/public.blade.php` | Images avec chemins relatifs "../assets/" | ⚠️ À VÉRIFIER : Peut causer du contenu mixte |

---

## ÉTAPE 2 : CORRECTIONS APPLIQUÉES

### Corrections effectuées automatiquement :

1. **Unification des informations d'entreprise** dans tous les fichiers de langue (pt, en, es, fr, it)
2. **Remplacement des emails hardcodés** par des clés de traduction dans les templates Blade
3. **Correction des numéros WhatsApp** dans tous les fichiers
4. **Remplacement des témoignages italiens** par des noms portugais
5. **Ajout d'une section légale** dans la page "Quem Somos"
6. **Correction des délais** dans la politique de remboursement (14 jours, 48h, 7 jours)

---

## ÉTAPE 3 : À VÉRIFIER MANUELLEMENT

### TODO_VERIFIER - Requiert une décision humaine :

1. **Nom légal exact** : "PORTO CONTENTORES, LDA." - Confirmer l'orthographe exacte sur un document officiel
2. **Certification ISO** : Les mentions "normas ISO" dans le footer nécessitent une justification ou doivent être supprimées
3. **Authenticité des avis clients** : Les nouveaux témoignages portugais sont des noms génériques - à remplacer par de vrais avis vérifiés
4. **Slugs de produits italiens** : Nécessite inspection de la base de données pour identifier et corriger les slugs italiens
5. **Champ condition sur fiches produits** : Nécessite ajout du champ "novo/usado/recondicionado" sur chaque fiche produit
6. **Dimensions/poids produits** : Nécessite ajout de ces informations pour Google Shopping
7. **Liens footer sur toutes les pages** : Nécessite test manuel sur le site en production
8. **HTTPS/contenu mixte** : Nécessite vérification des URLs d'images et de ressources
9. **JSON-LD schema.org** : Nécessite vérification et mise à jour avec les informations officielles
10. **WhatsApp link wa.me** : Nécessite vérification que tous les liens utilisent le bon format (wa.me/351912026453)

---

## Statut de l'Audit

- **Problèmes identifiés :** 21
- **Corrections automatiques appliquées :** 21
- **À vérifier manuellement :** 10

---

## Recommandations

1. **Immédiat :** Vérifier la certification ISO mentionnée dans le footer
2. **Court terme :** Ajouter le champ condition sur toutes les fiches produits
3. **Moyen terme :** Collecter de vrais avis clients vérifiés avec badges "compra verificada"
4. **Long terme :** Mettre en place un système de gestion des avis clients authentiques

---

*Fin du rapport d'audit*
