import { Button } from '@/components/ui/button'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import {
  Edit,
  EllipsisVertical,
  SquareArrowOutUpRight,
  Trash,
} from 'lucide-react'
import Link from 'next/link'

export default function ReservaTableActions({
  row,
  openDeleteModal,
  openEditModal,
}) {
  return (
    <>
      <DropdownMenu>
        <DropdownMenuTrigger asChild>
          <Button
            variant="ghost"
            className="flex h-8 w-4 p-0 data-[state=open]:bg-muted">
            <EllipsisVertical className="h-4 w-4" />
            <span className="sr-only">Abrir menú</span>
          </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" className="w-[160px]">
          <DropdownMenuItem
            onClick={() => {
              openEditModal()
            }}>
            <Edit className="mr-2 h-4 w-4" />
            Editar
          </DropdownMenuItem>
          <DropdownMenuSeparator />
          <DropdownMenuItem>
            <Link
              href={`reservas/${row.id}`}
              className="flex flex-row items-center justify-center">
              <SquareArrowOutUpRight className="mr-2 h-4 w-4" />
              <span>Detalle | equipos</span>
            </Link>
          </DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </>
  )
}
