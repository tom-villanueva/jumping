import { useMemo } from 'react'

const useAccumulatedTotals = data => {
  return useMemo(() => {
    // Initialize maps for each attribute
    const tipoMap = new Map()
    const marcaMap = new Map()
    const modeloMap = new Map()
    const talleMap = new Map()

    // Use one loop to accumulate totals for all attributes
    data.forEach(({ stock, tipo_articulo, marca, modelo, talle }) => {
      // Update tipo_articulo total
      const tipoDesc = tipo_articulo.descripcion
      tipoMap.set(tipoDesc, (tipoMap.get(tipoDesc) || 0) + stock)

      // Update marca total
      const marcaDesc = marca.descripcion
      marcaMap.set(marcaDesc, (marcaMap.get(marcaDesc) || 0) + stock)

      // Update modelo total
      const modeloDesc = modelo.descripcion
      modeloMap.set(modeloDesc, (modeloMap.get(modeloDesc) || 0) + stock)

      // Update talle total
      const talleDesc = talle.descripcion
      talleMap.set(talleDesc, (talleMap.get(talleDesc) || 0) + stock)
    })

    // Convert the maps to arrays of objects with { name, value }
    const toTotalizerArray = map =>
      Array.from(map, ([name, value]) => ({ name, value }))

    return {
      tipoTotalizers: toTotalizerArray(tipoMap),
      marcaTotalizers: toTotalizerArray(marcaMap),
      modeloTotalizers: toTotalizerArray(modeloMap),
      talleTotalizers: toTotalizerArray(talleMap),
    }
  }, [data]) // Only recompute if data changes
}

export default useAccumulatedTotals
