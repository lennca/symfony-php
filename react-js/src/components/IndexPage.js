import React, { useEffect, useState } from 'react';
import { fetchData } from '../services/APIService';
import { Sort } from './utils/Sort';

function IndexPage(props) {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    async function fetchDataFromAPI() {
      try {
        const { data: { products } = [] } = await fetchData()
        const sortedProducts = Sort(products, 'artiklar_benamning')
        sortedProducts.map((prod) => console.log(prod.artiklar_benamning))
        setProducts(products)
      } catch (error) {
        console.log(error.message)
      }
    }

    fetchDataFromAPI()
  }, [])

  return (
    <div>
      <h1>Arbetsprov Montania</h1>
      <h3>Info:</h3>
      <div>
        <p>Lägst pris: </p>
        <p>Högst pris: </p>
        <p>Antal artiklar: </p>
      </div>
      <h3>Kategorier:</h3>
    </div>
  );
}

export default IndexPage;