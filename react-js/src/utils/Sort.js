/**
 * Function that sort array in ascending order.
 * @param {array} unsortedArray Array of unsorted objects.
 * @param {string} key Key of key/value-pair to be compared.
 * @returns {array} Sorted array.
 */
function Sort(unsortedArray, key) {
  const sortedArray = [...unsortedArray.sort((curr, next) => curr[key] > next[key])]
  return sortedArray
}

export { Sort }