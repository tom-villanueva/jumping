import useSWR from 'swr'

export function useModelos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/modelos', qs])

  return {
    modelos: data,
    isLoading,
    isError: error,
  }
}
