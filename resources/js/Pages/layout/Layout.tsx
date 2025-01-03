import { lazy } from "react";
import { Footer, Navbar, ScrollProgress } from "../../components";

import BackToTop from "../../components/BackToTop.jsx";
import NewLetter from "../../components/footer/newsLetter/NewsLetter.jsx";
import PreLoadingPage from "../preLoadingPage/PreLoadingPage";

// NotFound page
const NotFoundPage = lazy(() => import("../notFoundPage/NotFoundPage"));

function Layout({ children }: { children: React.ReactNode }) {
    return (
        <div className="flex flex-col min-h-screen relative overflow-hidden max-w-[1440px] mx-auto">
            <ScrollProgress />
            <Navbar />
            <main className="flex-grow">
                {children}
                {/*
                <Routes>
                    <Route
                        path="*"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <NotFoundPage />
                            </Suspense>
                        }
                    />
                </Routes>
                */}
            </main>
            <BackToTop />
            <NewLetter className="flex md:hidden" />
            <Footer />
        </div>
    );
}

export default Layout;
