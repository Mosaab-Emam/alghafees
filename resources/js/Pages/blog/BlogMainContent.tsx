import { Post } from "@/types";
import BlogTopSection from "./blogTopSection/BlogTopSection";
import BlogsBox from "./blogsBox/BlogsBox";

export default function ServicesMainContent({ posts }: { posts: Array<Post> }) {
    return (
        <section className="container md:mt-[211px] mt-[6rem]">
            <BlogTopSection />
            <BlogsBox posts={posts} />
        </section>
    );
}
