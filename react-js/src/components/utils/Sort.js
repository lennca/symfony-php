function Sort(unsortedArray, key) {
  const sortedArray = [...unsortedArray.sort((curr, next) => curr[key] > next[key])]
  return sortedArray
}

export { Sort }