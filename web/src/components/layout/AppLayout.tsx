import { Outlet } from "react-router";
import { ThemeToggle } from "@/components/shared/ThemeToggle";

export const AppLayout = () => {

  return (
    <>
      <header className="flex h-15 shrink-0 items-center justify-between gap-2 border-b px-4 shadow-xl">
        <h1 className="text-3xl font-bold text-primary text-shadow-lg/20">SICTEC</h1>
        <ThemeToggle />
      </header>

      <div className="flex-1 overflow-y-auto p-6">
        <Outlet />
      </div>
    </>
  );
};
