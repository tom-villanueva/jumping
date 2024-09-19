import useSWR from 'swr'

export function useTipoArticuloTalles({ params, filters } = {}) {
  const filterParams = {}

  filters.forEach(filter => {
    filterParams[`filter[${filter.id}]`] = filter.value
  })

  const allParams = {
    ...params,
    ...filterParams,
  }

  const queryParams = new URLSearchParams(allParams)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/tipo-articulo-talles', qs])

  return {
    tipoArticuloTalles: data,
    isLoading,
    isError: error,
  }
}
