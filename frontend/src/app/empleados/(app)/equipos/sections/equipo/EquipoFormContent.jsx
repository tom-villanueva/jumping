'use client'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import SubmitButton from '@/components/SubmitButton'
import InputError from '@/components/InputError'
import EquipoTipoArticuloTable from './EquipoTipoArticuloTable'
import { Separator } from '@/components/ui/separator'
import { useFormState } from 'react-dom'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useContext, useEffect } from 'react'
import { useToast } from '@/components/ui/use-toast'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'

export default function EquipoFormContent({
  onFormSubmit,
  equipo,
  serverAction,
}) {
  const { toast } = useToast()
  const { selected } = useContext(SelectManyEntitiesContext)
  const [formState, action] = useFormState(
    serverAction.bind(null, selected),
    EMPTY_FORM_STATE,
  )

  useEffect(() => {
    if (formState.status === 'SUCCESS') {
      toast({
        title: `😄 ${formState.message}`,
      })
      onFormSubmit()
    } else if (
      formState.status === 'ERROR' &&
      Object.keys(formState.fieldErrors).length == 0
    ) {
      toast({
        title: `🥲 ${formState.message}`,
        description: 'Intente de nuevo más tarde.',
        variant: 'destructive',
      })
    }
  }, [formState])

  return (
    <form
      action={action}
      className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
      <Label htmlFor="descripcion">Descripcion</Label>
      <Input
        id="descripcion"
        name="descripcion"
        placeholder="Escriba descripcion"
        className="col-span-12"
        required
        defaultValue={equipo?.descripcion}
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
        defaultValue={equipo?.precio}
        className="col-span-12"
        required
        min="0"
      />
      <InputError
        messages={formState.fieldErrors.precio}
        className="col-span-12"
      />
      <div className="col-span-12 flex items-center space-x-2">
        {/* Input hidden para mandar el estado unchecked */}
        <input type="hidden" name="disponible" value={false} />
        <Checkbox
          id="disponible"
          name="disponible"
          defaultChecked={equipo?.disponible}
          value={true}
        />
        <Label
          htmlFor="disponible"
          className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
          Disponible (visible para reservar)
        </Label>
      </div>
      <Separator className="col-span-12" />
      <Label className="col-span-12 font-medium">Compuesto por:</Label>
      <EquipoTipoArticuloTable />
      <SubmitButton
        label="Guardar"
        loading="Guardando..."
        className="col-span-6"
      />
      <input type="hidden" name="equipoId" value={equipo?.id ?? ''} />
    </form>
  )
}
