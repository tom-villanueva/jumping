'use client'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { EMPTY_FORM_STATE, convertToUTC, formatDate } from '@/lib/utils'
import { useEffect } from 'react'
import { useFormState } from 'react-dom'
import { useForm } from 'react-hook-form'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { editEquipoDescuento } from '../../equipos-actions'
import { useToast } from '@/components/ui/use-toast'
import SubmitButton from '@/components/SubmitButton'
import InputError from '@/components/InputError'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

export default function EquipoDescuentoUpdateFormModal({
  openForm,
  setOpenForm,
  onFormSubmit,
  descuento,
  equipo,
}) {
  const { toast } = useToast()
  const [formState, action] = useFormState(
    editEquipoDescuento,
    EMPTY_FORM_STATE,
  )
  const form = useForm({
    defaultValues: {
      fecha_desde: '',
      fecha_hasta: '',
    },
  })

  useEffect(() => {
    if (formState?.status === 'SUCCESS') {
      toast({
        title: `😄 ${formState?.message}`,
      })
      onFormSubmit()
    } else if (
      formState?.status === 'ERROR' &&
      Object.keys(formState?.fieldErrors).length == 0
    ) {
      toast({
        title: `🥲 ${formState?.message}`,
        description: 'Intente de nuevo.',
        variant: 'destructive',
      })
    }
  }, [formState])

  useEffect(() => {
    form.setValue('fecha_desde', descuento?.pivot?.fecha_desde)
    form.setValue('fecha_hasta', descuento?.pivot?.fecha_hasta)
  }, [descuento])

  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Cambiar fechas a descuento</DialogTitle>
        </DialogHeader>
        <Form {...form}>
          <form action={action} className="grid w-full grid-cols-12 gap-2">
            <FormField
              name="fecha_desde"
              control={form.control}
              render={({ field }) => (
                <FormItem className="col-span-6">
                  <FormLabel>Fecha Inicio</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_desde"
                      min={today}
                      {...field}
                    />
                  </FormControl>
                  <InputError
                    messages={formState?.fieldErrors?.fecha_desde}
                    className="col-span-12"
                  />
                </FormItem>
              )}
            />
            <FormField
              name="fecha_hasta"
              control={form.control}
              render={({ field }) => (
                <FormItem className="col-span-6">
                  <FormLabel>Fecha Fin</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_hasta"
                      min={today}
                      {...field}
                    />
                  </FormControl>
                  <InputError
                    messages={formState?.fieldErrors?.fecha_hasta}
                    className="col-span-12"
                  />
                </FormItem>
              )}
            />
            <SubmitButton
              label="Guardar"
              loading="Guardando..."
              className="col-span-12"
            />
            <input
              type="hidden"
              name="descuentoId"
              value={descuento?.id ?? ''}
            />
            <input
              type="hidden"
              name="equipoDescuentoId"
              value={descuento?.pivot?.id ?? ''}
            />
            <input type="hidden" name="equipoId" value={equipo?.id ?? ''} />
            <InputError
              messages={formState?.fieldErrors?.equipo_id}
              className="col-span-12"
            />
          </form>
        </Form>
      </DialogContent>
    </Dialog>
  )
}
