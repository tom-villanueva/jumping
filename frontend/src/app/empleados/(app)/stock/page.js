'use client'

import { useState } from 'react'
import StockGraphs from './StockGraphs'
import StockTable from './StockTable'
import { useInventarios } from '@/services/inventarios'
import { useDebounce } from '@/hooks/useDebounce'
import Header from '../Header'

export default function StockPage() {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)

  const { inventarios, isLoading, isError, isValidating } = useInventarios({
    params: {
      include: 'tipo_articulo,talle,marca,modelo',
    },
    filters: debouncedColumnFilters,
  })

  const columns = [
    {
      accessorKey: 'tipo_articulo.descripcion',
      id: 'tipo_articulo_id',
      header: 'Tipo',
    },
    {
      accessorKey: 'talle.descripcion',
      id: 'talle_id',
      header: 'Talle',
    },
    {
      accessorKey: 'marca.descripcion',
      id: 'marca_id',
      header: 'Marca',
    },
    {
      accessorKey: 'modelo.descripcion',
      id: 'modelo_id',
      header: 'Modelo',
    },
    {
      accessorKey: 'stock',
      id: 'stock',
      header: 'Stock Total',
    },
  ]

  return (
    <>
      <Header title="Stock" />
      <div className="container mx-auto pt-10">
        <StockTable
          columns={columns}
          columnFilters={columnFilters}
          setColumnFilters={setColumnFilters}
          debouncedColumnFilters={debouncedColumnFilters}
        />
        {isLoading || isValidating ? (
          'cargando'
        ) : (
          <StockGraphs inventario={inventarios} />
        )}
      </div>
    </>
  )
}
