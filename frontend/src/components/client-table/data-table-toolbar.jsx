'use client'

import { XIcon } from 'lucide-react'
import { Button } from '../ui/button'
import { Input } from '../ui/input'
import { DataTableFacetedFilter } from './data-table-faceted-filter'
import { Label } from '../ui/label'

export function DataTableToolbar({ table, filters }) {
  const isFiltered = table.getState().columnFilters.length > 0

  return (
    <div className="flex items-center justify-between overflow-x-auto pb-2">
      <div className="flex flex-1 items-end space-x-2">
        {filters &&
          filters.length > 0 &&
          filters.map(filter => {
            const column = table.getColumn(filter.columnName)

            if (!column) return null

            switch (filter.type) {
              case 'text':
                return (
                  <Input
                    key={filter.columnName}
                    placeholder={`Filtrar ${filter.title}`}
                    value={column.getFilterValue() ?? ''}
                    onChange={event =>
                      column.setFilterValue(event.target.value)
                    }
                    className="h-8 w-[150px] lg:w-[200px]"
                  />
                )

              case 'select':
                return (
                  <DataTableFacetedFilter
                    key={filter.columnName}
                    column={column}
                    title={filter.title}
                    options={filter.options}
                  />
                )

              case 'date':
                return (
                  <div className="flex flex-col gap-1" key={filter.columnName}>
                    <Label>{`Filtrar ${filter.title}`}</Label>
                    <Input
                      type="date"
                      value={column.getFilterValue() ?? ''}
                      onChange={event =>
                        column.setFilterValue(event.target.value)
                      }
                      placeholder={`Seleccionar ${filter.title}`}
                      className="h-8 w-[150px] lg:w-[250px]"
                    />
                  </div>
                )

              default:
                return null
            }
          })}
        {isFiltered && (
          <Button
            variant="ghost"
            onClick={() => table.resetColumnFilters()}
            className="h-8 px-2 lg:px-3">
            Reset
            <XIcon className="ml-2 h-4 w-4" />
          </Button>
        )}
      </div>
    </div>
  )
}
