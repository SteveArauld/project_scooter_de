{{--
    Google-Merchant-Center-Produktfeed (RSS 2.0).
    Pflichtfelder je Artikel: id, title, description, link, image_link,
    availability, price, brand, condition sowie gtin/mpn bzw. identifier_exists.
--}}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
  <channel>
    <title>{{ config('shop.name') }}</title>
    <link>{{ url('/') }}</link>
    <description>{{ config('shop.default_description') }}</description>
@foreach($products as $product)
@php
    $title = $product->getTranslation('title', 'de');
    $description = $product->plainDescription(4900) ?: $title;
    $images = $product->imageUrls();
    /*
     | g:price muss immer den regulären Preis tragen. Ist der Artikel im Shop
     | reduziert (Streichpreis hinterlegt), kommt der Aktionspreis zusätzlich
     | als g:sale_price dazu – sonst beanstandet das Merchant Center die
     | Abweichung zwischen Landingpage und Feed.
     */
    $price = number_format($product->regular_price, 2, '.', '') . ' EUR';
    $salePrice = $product->sale_price !== null
        ? number_format($product->sale_price, 2, '.', '') . ' EUR'
        : null;
@endphp
    <item>
      <g:id>{{ $product->id }}</g:id>
      <g:title>{{ \Illuminate\Support\Str::limit($title, 150, '') }}</g:title>
      <g:description>{{ $description }}</g:description>
      <g:link>{{ route('products.show', $product->slug) }}</g:link>
      <g:image_link>{{ url($product->main_image) }}</g:image_link>
@foreach(array_slice($images, 1, 10) as $extra)
      <g:additional_image_link>{{ url($extra) }}</g:additional_image_link>
@endforeach
      <g:condition>new</g:condition>
      <g:availability>{{ $product->feed_availability }}</g:availability>
@if($product->feed_availability === 'preorder' && $product->release_date)
      {{-- Pflichtfeld bei availability=preorder: ISO 8601 mit Zeitzone --}}
      <g:availability_date>{{ $product->release_date->toIso8601String() }}</g:availability_date>
@endif
      <g:price>{{ $price }}</g:price>
@if($salePrice)
      <g:sale_price>{{ $salePrice }}</g:sale_price>
@endif
@if($product->brand)
      <g:brand>{{ $product->brand }}</g:brand>
@endif
@if($product->mpn)
      <g:mpn>{{ $product->mpn }}</g:mpn>
      <g:identifier_exists>yes</g:identifier_exists>
@else
      <g:identifier_exists>no</g:identifier_exists>
@endif
@if($product->google_category)
      <g:google_product_category>{{ $product->google_category }}</g:google_product_category>
@endif
      <g:product_type>{{ $product->category_label }}</g:product_type>
      <g:shipping>
        <g:country>{{ config('shop.feed_shipping_country') }}</g:country>
        <g:service>{{ config('shop.feed_shipping_service') }}</g:service>
        <g:price>{{ number_format((float) config('shop.shipping_cost'), 2, '.', '') }} EUR</g:price>
      </g:shipping>
    </item>
@endforeach
  </channel>
</rss>
