import useSWR from 'swr'

export function useTrasladoPrecios({ params, filters } = {}) {
  const filterParams = {}

  filters &&
    filters.forEach(filter => {
      filterParams[`filter[${filter.id}]`] = filter.value
    })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR([
    '/api/traslado-precios',
    qs,
  ])

  return {
    trasladoPrecios: data,
    isLoading,
    isError: error,
    ...rest,
  }
}

export function useTrasladoAsientos({ params, filters } = {}) {
  const filterParams = {}

  filters &&
    filters.forEach(filter => {
      filterParams[`filter[${filter.id}]`] = filter.value
    })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR([
    '/api/traslado-asientos',
    qs,
  ])

  return {
    trasladoAsientos: data,
    isLoading,
    isError: error,
    ...rest,
  }
}

export function useAsientosDisponibles({ fechaDesde, fechaHasta } = {}) {
  const queryParams = new URLSearchParams()

  if (fechaDesde) queryParams.append('fecha_desde', fechaDesde)
  if (fechaHasta) queryParams.append('fecha_hasta', fechaHasta)

  const qs = queryParams.toString()

  const { data, error, isLoading, ...rest } = useSWR([
    '/api/traslado-asientos/check-disponibles',
    qs,
  ])

  return {
    asientos: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
