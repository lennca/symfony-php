import React from 'react';
import Artikel from './Artikel';

function Kategori({ kategori }) {
  return (
    <div>
      <h5>{kategori.category}</h5>
      {kategori.products.map((produkt) => {
        return <Artikel produkt={produkt} key={produkt.id} />
      })}
    </div>
  );
}

export default Kategori;