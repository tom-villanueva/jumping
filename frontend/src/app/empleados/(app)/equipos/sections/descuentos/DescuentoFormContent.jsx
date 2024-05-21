'use client'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import SubmitButton from '@/components/SubmitButton'
import InputError from '@/components/InputError'
import { useFormState } from 'react-dom'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useEffect } from 'react'
import { useToast } from '@/components/ui/use-toast'

export default function DescuentoFormContent({
  onFormSubmit,
  descuento,
  serverAction,
}) {
  const { toast } = useToast()
  const [formState, action] = useFormState(serverAction, EMPTY_FORM_STATE)

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
        defaultValue={descuento?.descripcion}
      />
      <InputError
        messages={formState?.fieldErrors?.descripcion}
        className="col-span-12"
      />
      <Label htmlFor="descripcion">Valor</Label>
      <Input
        id="valor"
        name="valor"
        placeholder="Escriba valor"
        type="number"
        className="col-span-12"
        required
        defaultValue={descuento?.valor}
      />
      <InputError
        messages={formState?.fieldErrors?.valor}
        className="col-span-12"
      />
      <div className="col-span-12 flex items-start space-x-2">
        {/* Input hidden para mandar el estado unchecked */}
        <input type="hidden" name="tipo_descuento" value={false} />
        <Checkbox
          id="tipo_descuento"
          name="tipo_descuento"
          defaultChecked={descuento?.tipo_descuento}
          value={true}
        />
        <Label
          htmlFor="tipo_descuento"
          className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
          (descuento o aumento)
        </Label>
      </div>
      <p className="col-span-12 text-sm text-white">
        Checkbox seleccionado significa que es descuento
      </p>
      <SubmitButton
        label="Guardar"
        loading="Guardando..."
        className="col-span-6"
      />
      <input type="hidden" name="descuentoId" value={descuento?.id ?? ''} />
    </form>
  )
}
