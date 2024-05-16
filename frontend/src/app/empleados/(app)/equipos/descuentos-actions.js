'use server'
import { z } from 'zod'
import { revalidateTag } from 'next/cache'
import { fromErrorToFormState, toFormState } from '@/lib/utils'
import {
  deleteDescuento,
  storeDescuento,
  updateDescuento,
} from '@/services/descuentos'

const descuentoSchema = z.object({
  descripcion: z.string(),
  valor: z
    .number({
      required_error: 'Se requiere stock',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  tipo_descuento: z.boolean(),
})

export async function saveDescuento(formState, formData) {
  //selected,
  try {
    const data = Object.fromEntries(formData)

    const descuento = descuentoSchema.parse({
      descripcion: data.descripcion,
      valor: Number(data.valor),
      tipo_descuento: data.tipo_descuento.toLowerCase() === 'true',
    })

    const res = await storeDescuento(descuento)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('descuentos')

  return toFormState('SUCCESS', 'Descuento guardado con éxito')
}

export async function editDescuento(formState, formData) {
  //selected,
  try {
    const data = Object.fromEntries(formData)

    const descuento = descuentoSchema.parse({
      descripcion: data.descripcion,
      valor: Number(data.valor),
      tipo_descuento: data.tipo_descuento.toLowerCase() === 'true',
    })

    const res = await updateDescuento(data.descuentoId, descuento)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('descuentos')

  return toFormState('SUCCESS', 'Descuento editado con éxito.')
}

export async function removeDescuento(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const res = await deleteDescuento(data.entityId)
  } catch (error) {
    return fromErrorToFormState(error)
  }
  revalidateTag('descuentos')

  return toFormState('SUCCESS', 'Descuento eliminado con éxito.')
}
