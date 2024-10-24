import useSWR from 'swr'

export function useTipoPersonas({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/tipo-personas', qs])

  return {
    tipoPersonas: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
