'use client'

import { XIcon } from 'lucide-react'

import { Button } from '../ui/button'
import { Input } from '../ui/input'

import { DataTableFacetedFilter } from './data-table-faceted-filter'

export function DataTableToolbar({ table, filters }) {
  const isFiltered = table.getState().columnFilters.length > 0

  return (
    <div className="flex items-center justify-between overflow-x-auto">
      <div className="flex flex-1 items-center space-x-2">
        {filters &&
          filters.length > 0 &&
          filters.map(filter =>
            filter.type === 'text' ? (
              <Input
                key={filter.title}
                placeholder={`Filtrar ${filter.title}`}
                value={
                  table.getColumn(filter.columnName)?.getFilterValue() ?? ''
                }
                onChange={event =>
                  table
                    .getColumn(filter.columnName)
                    ?.setFilterValue(event.target.value)
                }
                className="h-8 w-[150px] lg:w-[250px]"
              />
            ) : (
              table.getColumn(filter.columnName) && (
                <DataTableFacetedFilter
                  key={filter.title}
                  column={table.getColumn(filter.columnName)}
                  title={filter.title}
                  options={filter.options}
                />
              )
            ),
          )}
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
