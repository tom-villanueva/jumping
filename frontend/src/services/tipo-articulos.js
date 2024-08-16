import useSWR from 'swr'

export function useTipoArticulos({ params } = {}) {
  const queryParams = new URLSearchParams(params)

  const qs = queryParams.toString()

  const { data, error, isLoading } = useSWR(['/api/tipo-articulos', qs])

  return {
    tipoArticulos: data,
    isLoading,
    isError: error,
  }
}
