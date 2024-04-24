import { getEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { getTipoArticulos } from '@/services/tipo-articulos'

const Equipos = async () => {
  const equipos = await getEquipos({
    params: {
      include: 'equipo_tipo_articulo',
    },
  })

  const tipoArticulos = await getTipoArticulos()

  return (
    <div className="container mx-auto pt-10">
      <EquiposContainer equipos={equipos} tipoArticulos={tipoArticulos} />
    </div>
  )
}

export default Equipos
