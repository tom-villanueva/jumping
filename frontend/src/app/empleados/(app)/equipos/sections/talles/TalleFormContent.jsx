'use client'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import SubmitButton from '@/components/SubmitButton'
import InputError from '@/components/InputError'
import { useFormState } from 'react-dom'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useEffect } from 'react'
import { useToast } from '@/components/ui/use-toast'

export default function TalleFormContent({
  onFormSubmit,
  talle,
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
        defaultValue={talle?.descripcion}
      />
      <InputError
        messages={formState?.fieldErrors?.descripcion}
        className="col-span-12"
      />
      <SubmitButton
        label="Guardar"
        loading="Guardando..."
        className="col-span-6"
      />
      <input type="hidden" name="talleId" value={talle?.id ?? ''} />
    </form>
  )
}
