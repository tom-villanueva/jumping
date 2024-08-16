'use client'

import { useEquipos } from '@/services/equipos'
import EquiposContainer from './sections/equipo/EquiposContainer'
import { useTipoArticulos } from '@/services/tipo-articulos'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import TipoArticulosContainer from './sections/tipo-articulos/TipoArticulosContainer'
import { useTalles } from '@/services/talles'
import { useDescuentos } from '@/services/descuentos'
import TallesContainer from './sections/talles/TallesContainer'
import DescuentosContainer from './sections/descuentos/DescuentosContainer'

const Equipos = () => {
  const {
    equipos,
    isLoading: isLoadingEquipos,
    isError: isErrorEquipos,
  } = useEquipos({
    params: {
      include: 'equipo_tipo_articulo,descuentos_vigentes',
      sort: 'id',
    },
  })

  const {
    tipoArticulos,
    isLoading: isLoadingTipoArticulos,
    isError: isErrorTipoArticulos,
  } = useTipoArticulos({
    params: {
      include: 'tipo_articulo_talle',
      sort: 'id',
    },
  })

  const {
    talles,
    isLoading: isLoadingTalles,
    isError: isErrorTalles,
  } = useTalles({
    params: {
      include: 'tipo_articulo_talle',
      sort: 'id',
    },
  })

  const {
    descuentos,
    isLoading: isLoadingDescuentos,
    isError: isErrorDescuentos,
  } = useDescuentos({})

  if (
    isLoadingEquipos ||
    isLoadingTipoArticulos ||
    isLoadingDescuentos ||
    isLoadingTalles
  ) {
    return <p>Cargando...</p>
  }

  if (
    isErrorEquipos ||
    isErrorTipoArticulos ||
    isErrorDescuentos ||
    isErrorTalles
  ) {
    return <p>Error cargando los datos</p>
  }

  return (
    <div className="container mx-auto pt-10">
      {/* <Suspense fallback={<p>Loading...</p>}> */}
      <Tabs defaultValue="equipos" className="">
        <TabsList>
          <TabsTrigger value="equipos">Equipos</TabsTrigger>
          <TabsTrigger value="tipo_articulos">Tipos de Artículos</TabsTrigger>
          {/* <TabsTrigger value="talles">Talles</TabsTrigger>
          <TabsTrigger value="descuentos">Descuentos</TabsTrigger> */}
        </TabsList>
        <TabsContent value="equipos">
          <EquiposContainer
            equipos={equipos}
            tipoArticulos={tipoArticulos}
            descuentos={descuentos}
          />
        </TabsContent>
        <TabsContent value="tipo_articulos">
          <TipoArticulosContainer
            tipoArticulos={tipoArticulos}
            talles={talles}
          />
        </TabsContent>
        {/* <TabsContent value="talles">
          <TallesContainer talles={talles} tipoArticulos={tipoArticulos} />
        </TabsContent>
        <TabsContent value="descuentos">
          <DescuentosContainer descuentos={descuentos} />
        </TabsContent> */}
      </Tabs>
      {/* </Suspense> */}
    </div>
  )
}

export default Equipos
