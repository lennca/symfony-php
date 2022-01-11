import React, { useEffect, useState } from 'react';
import { fetchData } from '../services/APIService';
import { Sort } from '../utils/Sort';
import { AddMissingProperty } from '../utils/AddMissingProperty';
import { GroupProducts } from '../utils/GroupProducts';
import Kategori from './Kategori'

function IndexPage(props) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    setLoading(true)
    async function fetchDataFromAPI() {
      try {
        const { data: { products } = [] } = await fetchData()
        const updatedProducts = [...products.map((product) => AddMissingProperty(product))]
        const sortedProducts = Sort(updatedProducts, 'artiklar_benamning')
        sortedProducts.map((prod) => console.log(prod.artiklar_benamning))
        const categories = GroupProducts(sortedProducts)
        const sortedCategories = Sort(categories, 'category')
        setProducts(sortedCategories)
        setLoading(false)
      } catch (error) {
        console.log(error.message)
      }
    }

    fetchDataFromAPI()
  }, [])

  return (
    <div>
      <h1>Arbetsprov Montania</h1>
      {!loading && (
        <>
        <h3>Info:</h3>
        <div>
          <p>Lägst pris: </p>
          <p>Högst pris: </p>
          <p>Antal artiklar: </p>
        </div>
        <h3>Kategorier:</h3>
        {products.map((kategori) => {
          return <Kategori kategori={kategori}/>
        })}
        </>
      )}
    </div>
  );
}

export default IndexPage;