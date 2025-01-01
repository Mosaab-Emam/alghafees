export default function Container({ children }) {
  return (
    <div className="flex flex-col min-h-screen relative overflow-hidden max-w-[1440px] mx-auto">
      {children}
    </div>
  );
}
