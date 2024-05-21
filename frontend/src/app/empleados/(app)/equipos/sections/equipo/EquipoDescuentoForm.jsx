import { useFormState } from 'react-dom'
import { useForm } from 'react-hook-form'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
} from '@/components/ui/form'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Input } from '@/components/ui/input'
import { EMPTY_FORM_STATE, convertToUTC, formatDate } from '@/lib/utils'
import { useToast } from '@/components/ui/use-toast'
import { addEquipoDescuento } from '../../equipos-actions'
import { useEffect } from 'react'
import InputError from '@/components/InputError'
import SubmitButton from '@/components/SubmitButton'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

export default function EquipoDescuentoForm({ equipo, descuentos }) {
  const { toast } = useToast()
  const [formState, action] = useFormState(addEquipoDescuento, EMPTY_FORM_STATE)

  const form = useForm({
    defaultValues: {
      descuento_id: '',
      fecha_desde: '',
      fecha_hasta: '',
    },
  })

  useEffect(() => {
    if (formState.status === 'SUCCESS') {
      toast({
        title: `😄 ${formState?.message}`,
      })
      form.reset()
    } else if (
      formState.status === 'ERROR' &&
      Object.keys(formState?.fieldErrors).length == 0
    ) {
      toast({
        title: `🥲 ${formState?.message}`,
        description: 'Intente de nuevo.',
        variant: 'destructive',
      })
    }
  }, [formState])

  return (
    <Form {...form}>
      <form
        action={action}
        className="grid w-full grid-cols-12 items-end gap-4 pb-4">
        <FormField
          control={form.control}
          name="descuento_id"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-4">
              <FormLabel>Descuento</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un descuento" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {descuentos?.map(descuento => (
                    <SelectItem
                      key={descuento?.id}
                      value={String(descuento?.id)}>
                      {`${descuento?.descripcion} (${descuento?.valor}%)`}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <input type="hidden" name="descuentoId" value={field.value} />
              <InputError
                messages={formState?.fieldErrors?.descuento_id}
                className="col-span-12"
              />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_desde"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-3">
              <FormLabel>Fecha Inicio</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_desde" min={today} {...field} />
              </FormControl>
              <InputError
                messages={formState?.fieldErrors?.fecha_desde}
                className="col-span-12"
              />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_hasta"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-3">
              <FormLabel>Fecha Fin</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_hasta" min={today} {...field} />
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
          className="col-span-12 sm:col-span-2"
        />
        <input type="hidden" name="equipoId" value={equipo?.id ?? ''} />
        <InputError
          messages={formState?.fieldErrors?.equipo_id}
          className="col-span-12"
        />
      </form>
    </Form>
  )
}
