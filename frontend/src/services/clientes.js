import useSWR from 'swr'

export function useClientes({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/clientes', qs])

  return {
    clientes: data,
    isLoading,
    isError: error,
    ...rest,
  }
}

export function useEquiposClientes({ fechaDesde, fechaHasta, onSuccess } = {}) {
  const queryParams = new URLSearchParams()

  if (fechaDesde) queryParams.append('fecha_desde', fechaDesde)
  if (fechaHasta) queryParams.append('fecha_hasta', fechaHasta)

  const qs = queryParams.toString()
  const endpoint = qs ? `/api/clientes/equipos?${qs}` : '/api/clientes/equipos'

  const { data, error, isLoading, mutate, ...rest } = useSWR(endpoint, {
    suspense: false,
    revalidateOnMount: false,
    onSuccess: data => {
      if (onSuccess) onSuccess(data)
    },
  })

  return {
    equipos: data,
    isLoading,
    isError: error,
    fetchEquipos: mutate,
    ...rest,
  }
}
