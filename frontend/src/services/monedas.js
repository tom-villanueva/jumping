import useSWR from 'swr'

export function useMonedas({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/monedas', qs])

  return {
    monedas: data,
    isLoading,
    isError: error,
  }
}
