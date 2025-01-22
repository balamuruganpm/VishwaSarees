from django.shortcuts import render, get_object_or_404
from .models import Product

def product_detail(request, product_id):
    # Fetch the product by ID
    product = get_object_or_404(Product, id=product_id)
    
    # Fetch related products (same category, excluding the current product)
    related_products = Product.objects.filter(category=product.category).exclude(id=product.id)[:6]

    context = {
        'product': product,
        'related_products': related_products,
    }

    return render(request, 'product_detail.html', context)
