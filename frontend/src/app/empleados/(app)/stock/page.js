'use client'

import { useState } from 'react'
import StockGraphs from './StockGraphs'
import StockTable from './StockTable'
import { useInventarios } from '@/services/inventarios'
import { useDebounce } from '@/hooks/useDebounce'
import Header from '../Header'
import { Edit } from 'lucide-react'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '@/components/crud/CreateEditEntityModal'
import StockFormContent from './StockFormContent'

export default function StockPage() {
  const [columnFilters, setColumnFilters] = useState([])
  const debouncedColumnFilters = useDebounce(columnFilters, 1000)

  const [row, setRow] = useState({})
  const [openInventarioFormModal, setOpenInventarioFormModal] = useState(false)

  const { inventarios, isLoading, isError, isValidating } = useInventarios({
    params: {
      include: 'tipo_articulo,talle,marca,modelo,articulo',
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
    {
      header: 'Acciones',
      cell: ({ row }) => (
        <div className="flex flex-row gap-2">
          {row.original.articulo_id && (
            <Button
              onClick={() => {
                setRow(row.original)
                setOpenInventarioFormModal(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
          )}
        </div>
      ),
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
        <CreateEditEntityModal
          open={openInventarioFormModal}
          onOpenChange={() =>
            setOpenInventarioFormModal(!openInventarioFormModal)
          }
          editing={true}
          name="inventario">
          <StockFormContent
            inventario={row}
            onFormSubmit={() => {
              setOpenInventarioFormModal(!openInventarioFormModal)
            }}
          />
        </CreateEditEntityModal>
        {isLoading || isValidating ? (
          'cargando'
        ) : (
          <StockGraphs inventario={inventarios} />
        )}
      </div>
    </>
  )
}
