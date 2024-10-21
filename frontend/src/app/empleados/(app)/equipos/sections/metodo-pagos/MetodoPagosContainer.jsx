'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import MetodoPagoFormContent from './MetodoPagoFormContent'
import MetodoPagosTable from './MetodoPagosTable'

const METODO_PAGO_DEFAULT_VALUES = {
  descripcion: '',
  descuento_id: '',
}

export default function MetodoPagosContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedMetodoPago, setSelectedMetodoPago] = useState(
    METODO_PAGO_DEFAULT_VALUES,
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
      accessorKey: 'descuento',
      header: 'Descuento',
      cell: ({ row }) => {
        const modelo = row.original
        return <span>{modelo.descuento?.descripcion ?? '-'}</span>
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const metodo = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedMetodoPago(metodo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedMetodoPago(metodo)
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
        entity={selectedMetodoPago}
        apiKey="/api/metodo-pagos"
        name="método de pago"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedMetodoPago(METODO_PAGO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Método de Pago
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="modelo">
        <MetodoPagoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          metodo={selectedMetodoPago}
          editing={editing}
        />
      </CreateEditEntityModal>
      <MetodoPagosTable columns={columns} />
    </div>
  )
}
