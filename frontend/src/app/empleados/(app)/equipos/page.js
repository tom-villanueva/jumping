import { getEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { getTipoArticulos } from '@/services/tipo-articulos'
import { Suspense } from 'react'

const Equipos = async () => {
  const equipos = await getEquipos({
    params: {
      include: 'equipo_tipo_articulo',
      sort: 'id',
    },
  })

  const tipoArticulos = await getTipoArticulos()

  return (
    <div className="container mx-auto pt-10">
      <Suspense fallback={<p>Loading...</p>}>
        <EquiposContainer equipos={equipos} tipoArticulos={tipoArticulos} />
      </Suspense>
    </div>
  )
}

export default Equipos
