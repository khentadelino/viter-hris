import "./App.css";
import { QueryClientProvider, QueryClient } from "@tanstack/react-query";
import { Route, BrowserRouter as Router, Routes } from "react-router-dom";

function App() {
  const queryClient = new QueryClient();

  return (
    <>
      <QueryClientProvider client={queryClient}></QueryClientProvider>
    </>
  );
}

export default App;
