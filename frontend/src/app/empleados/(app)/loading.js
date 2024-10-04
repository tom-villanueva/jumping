import { Skeleton } from '@/components/ui/skeleton'

export default function Loading() {
  // You can add any UI inside Loading, including a Skeleton.
  return (
    <>
      <Skeleton className="mb-10 h-16 w-full" />
      <div className="container mx-auto pt-10">
        <Skeleton className="h-96 w-full" />
      </div>
    </>
  )
}
