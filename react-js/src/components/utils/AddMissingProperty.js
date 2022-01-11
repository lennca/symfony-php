function AddMissingProperty(object) {
  const { artiklar_benamning, lagersaldo, momssats, pris, artikelkategorier_id } = object
  const updatedObject = {
    artiklar_benamning: artiklar_benamning ? artiklar_benamning : "Odefinierad benämning",
    lagersaldo: lagersaldo ? lagersaldo : 0,
    momssats: momssats ? momssats : 0,
    pris: pris ? pris : 0,
    artikelkategorier_id: artikelkategorier_id ? artikelkategorier_id : "Odefinierad kategori"
  }
  return updatedObject
}

export { AddMissingProperty }