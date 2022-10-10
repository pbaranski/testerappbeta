/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */

import {ref, nextTick, onMounted, onBeforeUnmount} from 'vue';
import promiseDebounce from '@ohrm/oxd/utils/promiseDebounce';

type useInfiniteScrollArgs = {
  refName?: string;
  scrollDistance?: number;
  debounceInterval?: number;
};

interface CustomElement extends HTMLElement {
  $el: HTMLElement;
}

export default function useInfiniteScroll(
  executor: () => void,
  {
    refName = 'scrollerRef',
    scrollDistance = 100,
    debounceInterval = 100,
  }: useInfiniteScrollArgs = {},
) {
  let scrolledAmount = 0,
    isScrollDown = false;
  const scrollContainer = ref<CustomElement>();
  const onScroll = promiseDebounce(async () => executor(), debounceInterval);

  const onScrollEvent = () => {
    if (!scrollContainer.value) return;
    let scrollHeight, clientHeight, scrollTop;
    if (scrollContainer.value?.$el) {
      ({scrollHeight, clientHeight, scrollTop} = scrollContainer.value.$el);
    } else {
      ({scrollHeight, clientHeight, scrollTop} = scrollContainer.value);
    }

    // compare previous scroll with current scroll top to find vertical direction
    isScrollDown = scrollTop > scrolledAmount;
    scrolledAmount = scrollTop;

    // clientHeight = inner height of an element in pixels (without overflow)
    // scrollHeight = inner height of an element in pixels including overflown content
    // scrollTop = how much content is scrolled vertically in pixels
    const scrollerAtBottom =
      scrollTop + clientHeight >= scrollHeight - (scrollDistance || 0);
    if (isScrollDown && scrollerAtBottom) onScroll();
  };

  onMounted(async () => {
    await nextTick();
    if (scrollContainer.value?.$el) {
      scrollContainer.value.$el.addEventListener('scroll', onScrollEvent);
    } else {
      scrollContainer.value?.addEventListener('scroll', onScrollEvent);
    }
  });

  onBeforeUnmount(() => {
    if (scrollContainer.value?.$el) {
      scrollContainer.value?.$el.removeEventListener('scroll', onScrollEvent);
    } else {
      scrollContainer.value?.removeEventListener('scroll', onScrollEvent);
    }
  });

  return {
    [refName]: scrollContainer,
  };
}
