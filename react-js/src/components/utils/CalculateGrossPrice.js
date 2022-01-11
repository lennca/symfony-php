function CalculateGrossPrice(netPrice, tax) {
  const percentage = (tax / 100) + 1
  const total = Math.round(netPrice * percentage)
  return total
}

export { CalculateGrossPrice }