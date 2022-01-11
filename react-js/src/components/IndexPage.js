import React, { useEffect, useState } from 'react';
import { fetchData } from '../services/APIService';
import { Sort } from '../utils/Sort';
import { AddMissingProperty } from '../utils/AddMissingProperty';
import { GroupProducts } from '../utils/GroupProducts';
import { GetMaxPrice, GetMinPrice } from '../utils/Price'
import Kategori from './Kategori'
import './IndexPage.css'

function IndexPage() {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    setLoading(true)
    async function fetchDataFromAPI() {
      try {
        const { data: { products } = [] } = await fetchData()
        const updatedProducts = [...products.map((product) => AddMissingProperty(product))]
        const sortedProducts = Sort(updatedProducts, 'artiklar_benamning')
        setProducts(sortedProducts)
        setLoading(false)
      } catch (error) {
        console.log(error.message)
      }
    }

    fetchDataFromAPI()
  }, [])

  const groupProducts = (sortedProducts) => {
    const categories = GroupProducts(sortedProducts);
    const sortedCategories = Sort(categories, 'category');
    return sortedCategories;
  }

  return (
    <div>
      <h1>Arbetsprov Montania</h1>
      {!loading && (
        <>
        <h3>Info:</h3>
        <div id='info-container'>
          <p>Lägst pris: {GetMinPrice(products)}</p>
          <p>Högst pris: {GetMaxPrice(products)}</p>
          <p>Antal artiklar: </p>
        </div>
        <h3>Kategorier:</h3>
        {groupProducts(products).map((kategori) => {
          return <Kategori kategori={kategori} key={kategori.category}/>
        })}
        </>
      )}
    </div>
  );
}

export default IndexPage;