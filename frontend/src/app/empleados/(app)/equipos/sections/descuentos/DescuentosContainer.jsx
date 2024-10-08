'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import DescuentoFormContent from './DescuentoFormContent'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import DescuentosTable from './DescuentosTable'

const DESCUENTO_DEFAULT_VALUES = {
  descripcion: '',
  valor: 0,
  tipo_descuento: true,
}

export default function DescuentosContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedDescuento, setSelectedDescuento] = useState(
    DESCUENTO_DEFAULT_VALUES,
  )

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'descripcion',
      header: 'Descripción',
    },
    {
      accessorKey: 'valor',
      header: 'Valor',
    },
    {
      accessorKey: 'tipo_descuento',
      header: 'Tipo',
      cell: ({ row }) => {
        const tipo = row.getValue('tipo_descuento')

        return <span>{tipo ? 'Descuento' : 'Aumento'}</span>
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const descuento = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedDescuento(descuento)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedDescuento(descuento)
                setOpenDeleteForm(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  return (
    <div>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedDescuento}
        apiKey="/api/descuentos"
        name="descuento"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedDescuento(DESCUENTO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Descuento
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="descuento">
        <DescuentoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          descuento={selectedDescuento}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DescuentosTable columns={columns} />
    </div>
  )
}
