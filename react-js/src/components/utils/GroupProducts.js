function GroupProducts(products) {
  const groupedProducts = []
  products.forEach(product => {
    const { artiklar_benamning, lagersaldo, momssats, pris, artikelkategorier_id } = product
    let index = groupedProducts.findIndex(category => category.category.toLowerCase() === artikelkategorier_id.toLowerCase())
    if(index >= 0) {
      groupedProducts[index].products.push({
        artiklar_benamning, lagersaldo, momssats, pris, artikelkategorier_id
      })
    } else {
      groupedProducts.push({
        category: artikelkategorier_id,
        products: []
      })
      groupedProducts[groupedProducts.length -1].products.push({
        artiklar_benamning, lagersaldo, momssats, pris, artikelkategorier_id
      })
    }
  })
  return groupedProducts
}

export { GroupProducts }