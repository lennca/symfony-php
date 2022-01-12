/**
 * Function that group products with correct category.
 * @param {array} products Array of products.
 * @returns {array} Array of catecories including products.
 */
function GroupProducts(products) {
  const groupedProducts = []
  products.forEach(product => {
    let index = groupedProducts.findIndex(category => category.category.toLowerCase() === product.artikelkategorier_id.toLowerCase())
    if(index >= 0) {
      groupedProducts[index].products.push(product)
    } else {
      groupedProducts.push({
        category: product.artikelkategorier_id,
        products: []
      })
      groupedProducts[groupedProducts.length -1].products.push(product)
    }
  })
  return groupedProducts
}

export { GroupProducts }