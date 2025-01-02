import { Suspense, lazy } from "react";
import { Footer, Navbar, ScrollProgress } from "../../components";

import { BackendFile, SelectItem } from "@/types";
import { Route, Routes } from "react-router-dom"; // Corrected import
import BackToTop from "../../components/BackToTop.jsx";
import NewLetter from "../../components/footer/newsLetter/NewsLetter.jsx";
import PreLoadingPage from "../preLoadingPage/PreLoadingPage";

const Home = lazy(() => import("../home/Home"));
const AboutUs = lazy(() => import("../aboutUs/AboutUs"));
const OurClients = lazy(() => import("../ourClients/OurClients"));

const RequestEvaluation = lazy(
    () => import("../requestEvaluation/RequestEvaluation")
);

const JoinUs = lazy(() => import("../joinUs/JoinUs"));
const ContactUs = lazy(() => import("../contactUs/ContactUs"));
const TrackYourRequest = lazy(
    () => import("../trackYourRequest/TrackYourRequest")
);
const PrivacyPolicy = lazy(() => import("../privacyPolicy/PrivacyPolicy"));

// our services
const OurServices = lazy(() => import("../ourServices/OurServices"));
const ServicesMainContent = lazy(
    () => import("../ourServices/ServicesMainContent")
);
const OurServicesDetails = lazy(
    () => import("../nestedPages/ourServicesDetails/OurServicesDetails.jsx")
);

// Events
const Events = lazy(() => import("../events/Events"));
const EventsMainContent = lazy(() => import("../events/EventsMainContent"));
const EventDetailsPage = lazy(
    () => import("../nestedPages/eventDetailsPage/EventDetailsPage.jsx")
);

// blog
const Blog = lazy(() => import("../blog/Blog"));
const BlogMainContent = lazy(() => import("../blog/BlogMainContent"));
const BlogDetailsPage = lazy(
    () => import("../nestedPages/blogDetailsPage/BlogDetailsPage.jsx")
);

// NotFound page
const NotFoundPage = lazy(() => import("../notFoundPage/NotFoundPage"));

type LayoutProps = {
    reports: Array<BackendFile>;
    evaluations: Array<BackendFile>;
    home_report: BackendFile;
    goals: Array<SelectItem>;
    types: Array<SelectItem>;
    entities: Array<SelectItem>;
    usage: Array<SelectItem>;
};

function Layout({
    reports,
    evaluations,
    home_report,
    goals,
    types,
    entities,
    usage,
}: LayoutProps) {
    return (
        <div className="flex flex-col min-h-screen relative overflow-hidden max-w-[1440px] mx-auto">
            <ScrollProgress />
            <Navbar />
            <main className="flex-grow">
                <Routes>
                    <Route
                        path="/"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Home home_report={home_report} />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/about-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <AboutUs
                                    reports={reports}
                                    evaluations={evaluations}
                                />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/our-services"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <OurServices />
                            </Suspense>
                        }
                    >
                        <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <ServicesMainContent />
                                </Suspense>
                            }
                        />
                        <Route
                            path=":serviceId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <OurServicesDetails />
                                </Suspense>
                            }
                        />
                    </Route>

                    <Route
                        path="/our-clients"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <OurClients />
                            </Suspense>
                        }
                    />
                    {/* events */}
                    <Route
                        path="/events"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Events />
                            </Suspense>
                        }
                    >
                        <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <EventsMainContent />
                                </Suspense>
                            }
                        />
                        <Route
                            path=":eventId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <EventDetailsPage />
                                </Suspense>
                            }
                        />
                    </Route>
                    <Route
                        path="/request-evaluation"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <RequestEvaluation
                                    goals={goals}
                                    types={types}
                                    entities={entities}
                                    usage={usage}
                                />
                            </Suspense>
                        }
                    />

                    <Route
                        path="/blog"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Blog />
                            </Suspense>
                        }
                    >
                        <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <BlogMainContent />
                                </Suspense>
                            }
                        />
                        <Route
                            path=":blogId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <BlogDetailsPage />
                                </Suspense>
                            }
                        />
                    </Route>
                    <Route
                        path="/contact-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <ContactUs />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/join-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <JoinUs />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/track-your-request"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <TrackYourRequest />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/privacy-policy"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <PrivacyPolicy />
                            </Suspense>
                        }
                    />

                    <Route
                        path="*"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <NotFoundPage />
                            </Suspense>
                        }
                    />
                </Routes>
            </main>
            <BackToTop />
            <NewLetter className="flex md:hidden" />
            <Footer />
        </div>
    );
}

export default Layout;
