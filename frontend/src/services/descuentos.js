import useSWR from 'swr'

export function useDescuentos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/descuentos', qs])

  return {
    descuentos: data,
    isLoading,
    isError: error,
  }
}
