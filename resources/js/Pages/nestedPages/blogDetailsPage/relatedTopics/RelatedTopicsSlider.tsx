import { Post } from "@/types";
import { useRef } from "react";
import RelatedSlidBox from "./RelatedSlidBox";

export default function RelatedTopicsSlider({ posts }: { posts: Array<Post> }) {
    const swiperRef = useRef(null);
    return <RelatedSlidBox swiperRef={swiperRef} posts={posts} />;
}
