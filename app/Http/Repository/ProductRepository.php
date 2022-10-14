<?php

namespace App\Http\Repository;

use App\Models\Product;

class ProductRepository
{
	/**
	 * Get all product
	 */
	public function allProduct()
	{
		return Product::all();
	}

	/**
	 * Creat a single product
	 */
	public function createProduct($data)
	{
		return Product::create($data);
	}

	/**
	 * show Single data
	 */
	public function findOrFail($id)
	{
		return Product::findOrFail($id);
	}

	/**
	 * Update Single data
	 */
	public function update($id, $data)
	{
		$product = $this->findOrFail($id);
		return $product->update($data);
	}
}
