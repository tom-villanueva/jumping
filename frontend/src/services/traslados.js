import useSWR from 'swr'

export function useTraslados({ params, filters } = {}) {
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

  const { data, error, isLoading, ...rest } = useSWR(['/api/traslados', qs])

  return {
    traslados: data,
    isLoading,
    isError: error,
    ...rest,
  }
}
