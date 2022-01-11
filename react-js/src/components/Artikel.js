import React from 'react';
import { CalculateGrossPrice } from '../utils/CalculateGrossPrice'
import './Artikel.css'

function Artikel({ produkt }) {
  return (
    <div className='artikel-box'>
      <p className='artikel-item'>{produkt.artiklar_benamning}</p>
      <p className='artikel-item'>{CalculateGrossPrice(produkt.pris, produkt.momssats)} kr (inkl moms)</p>
      <p className='artikel-item'>{produkt.lagersaldo > 0 ? `I lager (${produkt.lagersaldo} kvar)` : 'Slutsåld'}</p>
    </div>
  );
}

export default Artikel;