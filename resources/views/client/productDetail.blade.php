<x-template.layout title="{{ $title }}" >
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
    <div class="container pt-md-5 pt-3">
      <x-organisms.product-detail :dataProduct="$product" />
    </div>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>