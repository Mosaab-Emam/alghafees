// import React, { PropsWithChildren, Suspense, lazy } from "react";
// import { Footer, Navbar, ScrollProgress } from "../_components";

import Navbar from "@/Components/Navbar";
import { PropsWithChildren } from "react";

// import { Route, Routes } from "react-router-dom"; // Corrected import
// import BackToTop from "../_components/BackToTop";
// import NewLetter from "../_components/footer/newsLetter/NewsLetter";
// import PreLoadingPage from "../_pages/preLoadingPage/PreLoadingPage";

// const Home = lazy(() => import("../_pages/home/Home"));
// const AboutUs = lazy(() => import("../_pages/aboutUs/AboutUs"));
// const OurClients = lazy(() => import("../_pages/ourClients/OurClients"));

// const RequestEvaluation = lazy(
//     () => import("../_pages/requestEvaluation/RequestEvaluation")
// );

// const JoinUs = lazy(() => import("../_pages/joinUs/JoinUs"));
// const ContactUs = lazy(() => import("../_pages/contactUs/ContactUs"));
// const TrackYourRequest = lazy(
//     () => import("../_pages/trackYourRequest/TrackYourRequest")
// );
// const PrivacyPolicy = lazy(
//     () => import("../_pages/privacyPolicy/PrivacyPolicy")
// );

// // our services
// const OurServices = lazy(() => import("../_pages/ourServices/OurServices"));
// const ServicesMainContent = lazy(
//     () => import("../_pages/ourServices/ServicesMainContent")
// );
// const OurServicesDetails = lazy(
//     () => import("../_pages/nestedPages/ourServicesDetails/OurServicesDetails")
// );

// // Events
// const Events = lazy(() => import("../_pages/events/Events"));
// const EventsMainContent = lazy(
//     () => import("../_pages/events/EventsMainContent")
// );
// const EventDetailsPage = lazy(
//     () => import("../_pages/nestedPages/eventDetailsPage/EventDetailsPage")
// );

// // blog
// const Blog = lazy(() => import("../_pages/blog/Blog"));
// const BlogMainContent = lazy(() => import("../_pages/blog/BlogMainContent"));
// const BlogDetailsPage = lazy(
//     () => import("../_pages/nestedPages/blogDetailsPage/BlogDetailsPage")
// );

// // NotFound page
// const NotFoundPage = lazy(() => import("../_pages/notFoundPage/NotFoundPage"));

export default function DefaultLayout({ children }: PropsWithChildren<{}>) {
    return (
        <div className="flex flex-col min-h-screen relative overflow-hidden max-w-[1440px] mx-auto">
            {/* <ScrollProgress / */}
            <Navbar />
            <main className="flex-grow">
                Layout
                {/* <Routes> */}
                {/* <Route
                        path="/"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Home />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/about-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <AboutUs />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/our-services"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <OurServices />
                            </Suspense>
                        }
                    > */}
                {/* <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <ServicesMainContent />
                                </Suspense>
                            }
                        /> */}
                {/* <Route
                            path=":serviceId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <OurServicesDetails />
                                </Suspense>
                            }
                        />
                    </Route> */}
                {/* <Route
                        path="/our-clients"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <OurClients />
                            </Suspense>
                        }
                    /> */}
                {/* events */}
                {/* <Route
                        path="/events"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Events />
                            </Suspense>
                        }
                    > */}
                {/* <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <EventsMainContent />
                                </Suspense>
                            }
                        /> */}
                {/* <Route
                            path=":eventId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <EventDetailsPage />
                                </Suspense>
                            }
                        />
                    </Route> */}
                {/* <Route
                        path="/request-evaluation"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <RequestEvaluation />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/blog"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <Blog />
                            </Suspense>
                        }
                    > */}
                {/* <Route
                            index
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <BlogMainContent />
                                </Suspense>
                            }
                        /> */}
                {/* <Route
                            path=":blogId"
                            element={
                                <Suspense fallback={<PreLoadingPage />}>
                                    <BlogDetailsPage />
                                </Suspense>
                            }
                        />
                    </Route> */}
                {/* <Route
                        path="/contact-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <ContactUs />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/join-us"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <JoinUs />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/track-your-request"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <TrackYourRequest />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="/privacy-policy"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <PrivacyPolicy />
                            </Suspense>
                        }
                    /> */}
                {/* <Route
                        path="*"
                        element={
                            <Suspense fallback={<PreLoadingPage />}>
                                <NotFoundPage />
                            </Suspense>
                        }
                    />
                </Routes> */}
                {children}
            </main>
            {/* <BackToTop />
            <NewLetter className="flex md:hidden" />
            <Footer /> */}
        </div>
    );
}
