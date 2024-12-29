import React, { PropsWithChildren, Suspense, lazy } from "react";
import { Footer, Navbar, ScrollProgress } from "../components";

import { Route, Routes } from "react-router-dom"; // Corrected import
import BackToTop from "../components/BackToTop";
import NewLetter from "../components/footer/newsLetter/NewsLetter";
import PreLoadingPage from "../Pages/preLoadingPage/PreLoadingPage";

const Home = lazy(() => import("../Pages/home/Home"));
const AboutUs = lazy(() => import("../Pages/aboutUs/AboutUs"));
const OurClients = lazy(() => import("../Pages/ourClients/OurClients"));

const RequestEvaluation = lazy(
    () => import("../Pages/requestEvaluation/RequestEvaluation")
);

const JoinUs = lazy(() => import("../Pages/joinUs/JoinUs"));
const ContactUs = lazy(() => import("../Pages/contactUs/ContactUs"));
const TrackYourRequest = lazy(
    () => import("../Pages/trackYourRequest/TrackYourRequest")
);
const PrivacyPolicy = lazy(
    () => import("../Pages/privacyPolicy/PrivacyPolicy")
);

// our services
const OurServices = lazy(() => import("../Pages/ourServices/OurServices"));
const ServicesMainContent = lazy(
    () => import("../Pages/ourServices/ServicesMainContent")
);
const OurServicesDetails = lazy(
    () => import("../Pages/nestedPages/ourServicesDetails/OurServicesDetails")
);

// Events
const Events = lazy(() => import("../Pages/events/Events"));
const EventsMainContent = lazy(
    () => import("../Pages/events/EventsMainContent")
);
const EventDetailsPage = lazy(
    () => import("../Pages/nestedPages/eventDetailsPage/EventDetailsPage")
);

// blog
const Blog = lazy(() => import("../Pages/blog/Blog"));
const BlogMainContent = lazy(() => import("../Pages/blog/BlogMainContent"));
const BlogDetailsPage = lazy(
    () => import("../Pages/nestedPages/blogDetailsPage/BlogDetailsPage")
);

// NotFound page
const NotFoundPage = lazy(() => import("../Pages/notFoundPage/NotFoundPage"));

function Layout({ children }: PropsWithChildren<{}>) {
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
                                <Home />
                            </Suspense>
                        }
                    />
                    <Route
                        path="/about-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <AboutUs />
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
                                <RequestEvaluation />
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
                {children}
            </main>
            <BackToTop />
            <NewLetter className="flex md:hidden" />
            <Footer />
        </div>
    );
}

export default Layout;
