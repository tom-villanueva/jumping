'use client'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import SubmitButton from '@/components/SubmitButton'
import InputError from '@/components/InputError'
import { Separator } from '@/components/ui/separator'
import { useFormState } from 'react-dom'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useContext, useEffect } from 'react'
import { useToast } from '@/components/ui/use-toast'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'
import TipoArticuloTalleTable from './TipoArticuloTalleTable'

export default function TipoArticuloFormContent({
  onFormSubmit,
  tipoArticulo,
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
      <Label htmlFor="descripcion">Descripción</Label>
      <Input
        id="descripcion"
        name="descripcion"
        placeholder="Escriba descripción"
        className="col-span-12"
        required
        defaultValue={tipoArticulo?.descripcion}
      />
      <InputError
        messages={formState?.fieldErrors?.descripcion}
        className="col-span-12"
      />
      <Separator className="col-span-12" />
      <Label className="col-span-12 font-medium">Asociado a:</Label>
      <TipoArticuloTalleTable />
      <SubmitButton
        label="Guardar"
        loading="Guardando..."
        className="col-span-6"
      />
      <input
        type="hidden"
        name="tipoArticuloId"
        value={tipoArticulo?.id ?? ''}
      />
    </form>
  )
}
