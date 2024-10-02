import useSWR from 'swr'

export function useMetodoPagos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/metodo-pagos', qs])

  return {
    metodos: data,
    isLoading,
    isError: error,
  }
}
