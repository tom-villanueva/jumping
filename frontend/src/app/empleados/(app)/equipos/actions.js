'use server'

import { z } from 'zod'
import { storeEquipo } from '@/services/equipos'
import { revalidateTag } from 'next/cache'
import { fromErrorToFormState, toFormState } from '@/lib/utils'

const tipoArticuloSchema = z.object({
  tipo_articulo_id: z.number(),
})

const equipoSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  precio: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  disponible: z.boolean(),
  tipo_articulo_ids: z.array(tipoArticuloSchema).nullable(),
})

export async function saveEquipo(formState, formData) {
  try {
    const data = Object.fromEntries(formData)

    const equipo = equipoSchema.parse({
      descripcion: data.descripcion,
      precio: parseInt(data.precio),
      disponible: data.disponible.toLowerCase() === 'true',
      tipo_articulo_ids: null,
    })

    console.log(equipo)

    //const res = await storeEquipo(equipo)
  } catch (error) {
    console.log(error)
    return fromErrorToFormState(error)
  }
  return toFormState('SUCCESS', 'Equipo guardado')

  //revalidateTag('equipos')
}
