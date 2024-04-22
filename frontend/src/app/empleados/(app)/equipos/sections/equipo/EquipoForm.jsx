'use client'
import { saveEquipo } from '../../actions'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import { useFormState } from 'react-dom'
import SubmitButton from '@/components/SubmitButton'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import InputError from '@/components/InputError'
import EquipoTipoArticuloTable from './EquipoTipoArticuloTable'
import { Separator } from '@/components/ui/separator'
import { useState } from 'react'

export default function EquipoForm({ tipoArticulos }) {
  const [formState, action] = useFormState(saveEquipo, EMPTY_FORM_STATE)

  const [selected, setSelected] = useState([])

  function addTipoArticulo(tipoArticulo) {
    const tipo = tipoArticulos.find(tipo => tipo.id === Number(tipoArticulo.id))
    setSelected([...selected, tipo])
  }

  return (
    <div>
      <form
        action={action}
        className="grid grid-cols-12 w-full gap-2 gap-y-4 rounded p-2">
        <Label htmlFor="descripcion">Descripcion</Label>
        <Input
          id="descripcion"
          name="descripcion"
          placeholder="Escriba descripcion"
          className="col-span-12"
          required
        />
        <InputError
          messages={formState.fieldErrors.descripcion}
          className="col-span-12"
        />
        <Label htmlFor="precio">Precio</Label>
        <Input
          id="precio"
          name="precio"
          type="number"
          placeholder="Escriba precio"
          defaultValue={0}
          className="col-span-12"
          required
          min="0"
        />
        <InputError
          messages={formState.fieldErrors.precio}
          className="col-span-12"
        />
        <div className="flex items-center space-x-2 col-span-12">
          {/* Input hidden para mandar el estado unchecked */}
          <input type="hidden" name="disponible" value={false} />
          <Checkbox
            id="disponible"
            name="disponible"
            defaultChecked={true}
            value={true}
          />
          <Label
            htmlFor="disponible"
            className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
            Disponible (visible para reservar)
          </Label>
        </div>
        <Separator className="col-span-12" />
        <Label className="font-medium col-span-12">Compuesto por:</Label>
        <EquipoTipoArticuloTable
          tipoArticulos={tipoArticulos}
          selected={[]}
          setSelected={() => {}}
        />
        <SubmitButton
          label="Guardar"
          loading="Guardando..."
          className="col-span-6"
        />
      </form>
    </div>
  )
}
